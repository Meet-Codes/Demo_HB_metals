-- HB Metals Master Database Schema (PostgreSQL / pgsql)
-- Strict ANSI SQL & PostgreSQL 12+ compliant with SERIAL primary keys & TIMESTAMP fields

CREATE TABLE IF NOT EXISTS site_settings (
    id SERIAL PRIMARY KEY,
    site_name VARCHAR(255) NOT NULL,
    site_tagline VARCHAR(255) NULL,
    logo_path VARCHAR(255) NULL,
    favicon_path VARCHAR(255) NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    address_line_1 VARCHAR(255) NOT NULL,
    address_line_2 VARCHAR(255) NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    alternate_postal_code VARCHAR(20) NULL,
    postal_code_note TEXT NULL,
    country VARCHAR(100) NOT NULL DEFAULT 'India',
    map_embed_url TEXT NULL,
    social_links_json TEXT NULL,
    seo_default_title VARCHAR(255) NULL,
    seo_default_description TEXT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS pages (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    page_type VARCHAR(50) NOT NULL DEFAULT 'standard',
    summary TEXT NULL,
    body_content TEXT NULL,
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    canonical_url VARCHAR(255) NULL,
    robots_directive VARCHAR(100) DEFAULT 'index, follow',
    status VARCHAR(20) DEFAULT 'published',
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS product_categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    short_description TEXT NULL,
    long_description TEXT NULL,
    parent_id INTEGER NULL,
    image_path VARCHAR(255) NULL,
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    status VARCHAR(20) DEFAULT 'published',
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES product_categories (id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS products (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    category_id INTEGER NULL,
    short_description TEXT NULL,
    description TEXT NULL,
    chemical_name VARCHAR(255) NULL,
    chemical_formula VARCHAR(255) NULL,
    cas_number VARCHAR(100) NULL,
    grade VARCHAR(100) NULL,
    purity_value VARCHAR(100) NULL,
    physical_form VARCHAR(255) NULL,
    particle_size VARCHAR(255) NULL,
    packaging_options_json TEXT NULL,
    minimum_order_quantity NUMERIC(10, 2) NULL,
    minimum_order_unit VARCHAR(50) DEFAULT 'Kilogram',
    availability_status VARCHAR(50) DEFAULT 'available',
    applications_json TEXT NULL,
    specifications_json TEXT NULL,
    handling_notes TEXT NULL,
    storage_notes TEXT NULL,
    featured INTEGER DEFAULT 0,
    status VARCHAR(20) DEFAULT 'published',
    source_url VARCHAR(255) NULL,
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    canonical_url VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES product_categories (id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS product_images (
    id SERIAL PRIMARY KEY,
    product_id INTEGER NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    alt_text VARCHAR(255) NULL,
    caption VARCHAR(255) NULL,
    is_primary INTEGER DEFAULT 0,
    sort_order INTEGER DEFAULT 0,
    origin_type VARCHAR(50) DEFAULT 'company',
    approval_status VARCHAR(50) DEFAULT 'approved',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS technical_documents (
    id SERIAL PRIMARY KEY,
    product_id INTEGER NULL,
    document_type VARCHAR(50) NOT NULL,
    title VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NULL,
    mime_type VARCHAR(100) DEFAULT 'application/pdf',
    file_size VARCHAR(50) NULL,
    revision VARCHAR(50) NULL,
    published_at DATE NULL,
    access_level VARCHAR(50) DEFAULT 'public',
    status VARCHAR(20) DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS faqs (
    id SERIAL PRIMARY KEY,
    product_id INTEGER NULL,
    category_id INTEGER NULL,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    sort_order INTEGER DEFAULT 0,
    status VARCHAR(20) DEFAULT 'published',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS enquiries (
    id SERIAL PRIMARY KEY,
    reference_code VARCHAR(50) NOT NULL UNIQUE,
    enquiry_type VARCHAR(50) NOT NULL DEFAULT 'rfq',
    name VARCHAR(255) NOT NULL,
    company_name VARCHAR(255) NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    country VARCHAR(100) DEFAULT 'India',
    destination VARCHAR(255) NULL,
    message TEXT NOT NULL,
    privacy_acknowledged_at TIMESTAMP NULL,
    status VARCHAR(50) DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS enquiry_items (
    id SERIAL PRIMARY KEY,
    enquiry_id INTEGER NOT NULL,
    product_id INTEGER NULL,
    requested_product_name VARCHAR(255) NULL,
    quantity NUMERIC(10, 2) NULL,
    quantity_unit VARCHAR(50) DEFAULT 'Kilogram',
    requested_grade VARCHAR(100) NULL,
    requested_purity VARCHAR(100) NULL,
    packaging_preference VARCHAR(255) NULL,
    target_date DATE NULL,
    specification_notes TEXT NULL,
    FOREIGN KEY (enquiry_id) REFERENCES enquiries (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS enquiry_attachments (
    id SERIAL PRIMARY KEY,
    enquiry_id INTEGER NOT NULL,
    stored_filename VARCHAR(255) NOT NULL,
    original_filename VARCHAR(255) NOT NULL,
    mime_type VARCHAR(100) NOT NULL,
    file_size INTEGER NOT NULL,
    scan_status VARCHAR(50) DEFAULT 'verified',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (enquiry_id) REFERENCES enquiries (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS url_redirects (
    id SERIAL PRIMARY KEY,
    source_path VARCHAR(255) NOT NULL UNIQUE,
    destination_path VARCHAR(255) NOT NULL,
    http_status INTEGER DEFAULT 301,
    active INTEGER DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS content_migration_audit (
    id SERIAL PRIMARY KEY,
    source_url VARCHAR(255) NOT NULL,
    source_title VARCHAR(255) NULL,
    source_status INTEGER DEFAULT 200,
    destination_url VARCHAR(255) NOT NULL,
    decision VARCHAR(50) NOT NULL,
    reason TEXT NULL,
    owner_approval VARCHAR(50) DEFAULT 'confirmed',
    checked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Performance & Lookup Indexes
CREATE INDEX IF NOT EXISTS idx_products_category ON products (category_id);
CREATE INDEX IF NOT EXISTS idx_products_slug ON products (slug);
CREATE INDEX IF NOT EXISTS idx_products_featured ON products (featured);
CREATE INDEX IF NOT EXISTS idx_products_status ON products (status);
CREATE INDEX IF NOT EXISTS idx_categories_slug ON product_categories (slug);
CREATE INDEX IF NOT EXISTS idx_product_images_product ON product_images (product_id);
CREATE INDEX IF NOT EXISTS idx_product_images_primary ON product_images (is_primary);
CREATE INDEX IF NOT EXISTS idx_technical_docs_product ON technical_documents (product_id);
CREATE INDEX IF NOT EXISTS idx_faqs_product ON faqs (product_id);
CREATE INDEX IF NOT EXISTS idx_faqs_category ON faqs (category_id);
CREATE INDEX IF NOT EXISTS idx_enquiries_ref ON enquiries (reference_code);
CREATE INDEX IF NOT EXISTS idx_enquiries_status ON enquiries (status);
CREATE INDEX IF NOT EXISTS idx_enquiry_items_enquiry ON enquiry_items (enquiry_id);
CREATE INDEX IF NOT EXISTS idx_enquiry_attachments_enquiry ON enquiry_attachments (enquiry_id);
CREATE INDEX IF NOT EXISTS idx_url_redirects_source ON url_redirects (source_path);

