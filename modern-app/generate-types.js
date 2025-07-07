const { createClient } = require('@supabase/supabase-js');

const supabase = createClient(
  'https://cxpojprgwgubzjyqzmoq.supabase.co',
  'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImN4cG9qcHJnd2d1YnpqeXF6bW9xIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDk2NjAwMDYsImV4cCI6MjA2NTIzNjAwNn0.vfs4e9lXMlwz7rjjqMX_qb7M-IRyvc2a7LaRd1AGgvE'
);

async function generateTypes() {
  console.log('📋 Analyse des tables pour générer les types...\n');
  
  // Tables principales à analyser
  const tables = [
    'pieces', 'pieces_gamme', 'pieces_price', 'pieces_media_img',
    'auto_marque', 'auto_modele', 'auto_type',
    'catalog_family', 'catalog_gamme'
  ];
  
  let typesContent = `// Auto-generated types from Supabase tables
export interface Database {
  public: {
    Tables: {\n`;
  
  for (const table of tables) {
    try {
      // Récupère un échantillon pour analyser la structure
      const { data, error } = await supabase
        .from(table)
        .select('*')
        .limit(1);
      
      if (!error && data && data.length > 0) {
        const sample = data[0];
        typesContent += `      ${table}: {
        Row: {\n`;
        
        // Génère les types basés sur l'échantillon
        for (const [key, value] of Object.entries(sample)) {
          let type = 'any';
          if (value === null) type = 'string | null';
          else if (typeof value === 'number') type = 'number';
          else if (typeof value === 'string') type = 'string';
          else if (typeof value === 'boolean') type = 'boolean';
          else if (value instanceof Date) type = 'string'; // dates as ISO strings
          
          typesContent += `          ${key}: ${type}\n`;
        }
        
        typesContent += `        }
        Insert: Partial<Database['public']['Tables']['${table}']['Row']>
        Update: Partial<Database['public']['Tables']['${table}']['Row']>
      }\n`;
        
        console.log(`✅ ${table}: ${Object.keys(sample).length} colonnes`);
      }
    } catch (err) {
      console.log(`⚠️  ${table}: Erreur d'accès`);
    }
  }
  
  typesContent += `    }
  }
}`;
  
  // Sauvegarde les types
  const fs = require('fs');
  fs.writeFileSync('packages/database/types/database.types.ts', typesContent);
  console.log('\n✅ Types générés dans packages/database/types/database.types.ts');
}

generateTypes();
