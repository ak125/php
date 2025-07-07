const { createClient } = require('@supabase/supabase-js');

// Vos credentials Supabase
const supabaseUrl = 'https://cxpojprgwgubzjyqzmoq.supabase.co';
const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImN4cG9qcHJnd2d1YnpqeXF6bW9xIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDk2NjAwMDYsImV4cCI6MjA2NTIzNjAwNn0.vfs4e9lXMlwz7rjjqMX_qb7M-IRyvc2a7LaRd1AGgvE';

const supabase = createClient(supabaseUrl, supabaseAnonKey);

async function test() {
  console.log('🧪 Test connexion Supabase...');
  
  try {
    // Test basique
    const { data, error } = await supabase.auth.getSession();
    console.log('Session:', data);
    
    // Test création table
    const { error: createError } = await supabase
      .from('test_connection')
      .insert({ test: 'hello' });
      
    if (createError) {
      console.log('Table test:', createError.message);
    }
    
  } catch (err) {
    console.error('Erreur:', err);
  }
}

test();
