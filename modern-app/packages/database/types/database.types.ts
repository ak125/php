// Auto-generated types from Supabase tables
export interface Database {
  public: {
    Tables: {
      pieces: {
        Row: {
          piece_id: number
          piece_ref: string
          piece_ref_clean: string
          piece_pm_id: number
          piece_pg_id: number
          piece_ga_id: number
          piece_des: string | null
          piece_name: string
          piece_name_comp: string | null
          piece_name_side: string | null
          piece_fil_id: number
          piece_fil_name: string
          piece_qty_sale: number
          piece_qty_pack: number
          piece_weight_kgm: number
          piece_has_oem: boolean
          piece_has_img: boolean
          piece_year: number
          piece_display: boolean
          piece_sort: number
          piece_update: boolean
          piece_pg_pid: number
          piece_psf_id: number
          search_vector: string | null
        }
        Insert: Partial<Database['public']['Tables']['pieces']['Row']>
        Update: Partial<Database['public']['Tables']['pieces']['Row']>
      }
      auto_marque: {
        Row: {
          marque_id: number
          marque_alias: string
          marque_name: string
          marque_name_url: string
          marque_name_meta: string
          marque_name_meta_title: string
          marque_logo: string | null
          marque_wall: string | null
          marque_relfollow: number
          marque_sitemap: number
          marque_display: number
          marque_sort: number
          marque_top: number
        }
        Insert: Partial<Database['public']['Tables']['auto_marque']['Row']>
        Update: Partial<Database['public']['Tables']['auto_marque']['Row']>
      }
      auto_modele: {
        Row: {
          modele_id: number
          modele_parent: number
          modele_marque_id: number
          modele_mdg_id: number
          modele_alias: string
          modele_name: string
          modele_name_url: string
          modele_name_meta: string | null
          modele_ful_name: string
          modele_month_from: number
          modele_year_from: number
          modele_month_to: string | null
          modele_year_to: string | null
          modele_body: string | null
          modele_pic: string
          modele_relfollow: number
          modele_sitemap: number
          modele_display: number
          modele_display_v1: string | null
          modele_sort: number
          modele_is_new: number
        }
        Insert: Partial<Database['public']['Tables']['auto_modele']['Row']>
        Update: Partial<Database['public']['Tables']['auto_modele']['Row']>
      }
      auto_type: {
        Row: {
          type_id: string
          type_tmf_id: string
          type_alias: string
          type_modele_id: string
          type_marque_id: string
          type_name: string
          type_name_url: string
          type_name_meta: string
          type_engine: string
          type_fuel: string
          type_power_ps: string
          type_power_kw: string
          type_liter: string
          type_month_from: string
          type_year_from: string
          type_month_to: string
          type_year_to: string
          type_body: string
          type_relfollow: string
          type_display: string
          type_sort: string
        }
        Insert: Partial<Database['public']['Tables']['auto_type']['Row']>
        Update: Partial<Database['public']['Tables']['auto_type']['Row']>
      }
    }
  }
}