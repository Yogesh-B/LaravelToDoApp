CREATE TABLE "record_lists" (
  "id" serial PRIMARY KEY,
  "list_name" varchar(100),
  "created_at" timestamp,
  "updated_at" timestamp,
  "deleted_at" timestamp
);

CREATE TABLE "notes" (
  "id" serial PRIMARY KEY,
  "record_list_id" integer FOREIGN KEY ("record_list_id") REFERENCES "record_lists" ("id"),
  "description" varchar(500),
  "is_completed" boolean,
  "created_at" timestamp,
  "updated_at" timestamp,
  "deleted_at" timestamp
);


