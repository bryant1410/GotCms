DROP TABLE IF EXISTS "blog_comment" CASCADE;
CREATE TABLE "blog_comment" (
    "id" serial NOT NULL,
    "created_at" timestamp without time zone NOT NULL,
    "username" character varying(255) NOT NULL,
    "email" character varying(255) NOT NULL,
    "show_email" boolean DEFAULT false,
    "is_active" boolean DEFAULT false,
    "message" text,
    "document_id" integer NOT NULL
) WITH OIDS;
ALTER TABLE "blog_comment" ADD CONSTRAINT "blog_comment_pk" PRIMARY KEY("id");
ALTER TABLE "blog_comment" ADD CONSTRAINT "fk_blog_comment_document" FOREIGN KEY ("document_id") REFERENCES "document"("id") ON UPDATE CASCADE ON DELETE CASCADE;
