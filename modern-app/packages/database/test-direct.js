const { Client } = require('pg');

async function test() {
  // Test connexion directe
  const directClient = new Client({
    connectionString: "postgresql://postgres:kJZwceLv8xtIaOLj@db.cxpojprgwgubzjyqzmoq.supabase.co:5432/postgres"
  });

  try {
    console.log('🔍 Test connexion directe...');
    await directClient.connect();
    const res = await directClient.query('SELECT COUNT(*) FROM pieces');
    console.log('✅ Direct OK! Pieces:', res.rows[0].count);
  } catch (err) {
    console.error('❌ Direct:', err.message);
  } finally {
    await directClient.end();
  }

  // Test pooler
  const pooledClient = new Client({
    connectionString: "postgresql://postgres.cxpojprgwgubzjyqzmoq:kJZwceLv8xtIaOLj@aws-0-eu-west-3.pooler.supabase.com:5432/postgres"
  });

  try {
    console.log('\n🔍 Test pooler...');
    await pooledClient.connect();
    const res = await pooledClient.query('SELECT COUNT(*) FROM pieces');
    console.log('✅ Pooler OK! Pieces:', res.rows[0].count);
  } catch (err) {
    console.error('❌ Pooler:', err.message);
  } finally {
    await pooledClient.end();
  }
}

test();
