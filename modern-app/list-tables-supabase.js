const { createClient } = require('@supabase/supabase-js');

const supabase = createClient(
  'https://cxpojprgwgubzjyqzmoq.supabase.co',
  'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImN4cG9qcHJnd2d1YnpqeXF6bW9xIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDk2NjAwMDYsImV4cCI6MjA2NTIzNjAwNn0.vfs4e9lXMlwz7rjjqMX_qb7M-IRyvc2a7LaRd1AGgvE'
);

async function test() {
  // Test simple sur une table
  const { data, error, count } = await supabase
    .from('pieces')
    .select('*', { count: 'exact', head: true });
    
  if (!error) {
    console.log('✅ Connexion OK!');
    console.log('📊 Table pieces:', count, 'lignes');
  } else {
    console.log('❌ Erreur:', error);
  }
  
  // Récupérons quelques données
  const { data: sample } = await supabase
    .from('pieces')
    .select('piece_id, piece_ref, piece_name')
    .limit(3);
    
  console.log('\n📦 Échantillon:', sample);
}

test();
