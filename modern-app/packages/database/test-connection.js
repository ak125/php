const { Client } = require('pg');

const client = new Client({
  connectionString: "postgresql://postgres.cxpojprgwgubzjyqzmoq:kJZwceLv8xtIaOLj@aws-0-eu-central-1.pooler.supabase.com:5432/postgres"
});

async function test() {
  try {
    await client.connect();
    console.log('✅ Connecté à Supabase!');
    
    const res = await client.query('SELECT NOW()');
    console.log('⏰ Heure serveur:', res.rows[0].now);
    
    const tables = await client.query(`
      SELECT tablename FROM pg_tables 
      WHERE schemaname = 'public'
    `);
    console.log('📊 Tables publiques:', tables.rows);
    
  } catch (err) {
    console.error('❌ Erreur:', err.message);
  } finally {
    await client.end();
  }
}

test();
