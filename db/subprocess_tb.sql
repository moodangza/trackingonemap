/*
 Navicat Premium Data Transfer

 Source Server         : real
 Source Server Type    : PostgreSQL
 Source Server Version : 130002 (130002)
 Source Host           : localhost:5432
 Source Catalog        : postgres
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 130002 (130002)
 File Encoding         : 65001

 Date: 12/03/2024 16:23:51
*/


-- ----------------------------
-- Table structure for subprocess_tb
-- ----------------------------
DROP TABLE IF EXISTS "public"."subprocess_tb";
CREATE TABLE "public"."subprocess_tb" (
  "subprocess_id" int4 NOT NULL DEFAULT nextval('subprocess_tb_subprocess_id_seq'::regclass),
  "job_id" int4,
  "process_id" int4,
  "subprocess_name" text COLLATE "pg_catalog"."default",
  "subprocess_start" date,
  "subprocess_end" date,
  "subprocess_finish" date,
  "subprocess_status" varchar COLLATE "pg_catalog"."default",
  "created_at" timestamp(6),
  "updated_at" timestamp(6),
  "delete_flag" varchar COLLATE "pg_catalog"."default",
  "deleted_at" timestamp(6)
)
;

-- ----------------------------
-- Records of subprocess_tb
-- ----------------------------
INSERT INTO "public"."subprocess_tb" VALUES (16, 7, 107, 'test200', '2024-04-05', '2024-04-06', '2024-02-28', '2', '2024-02-22 03:47:10', '2024-02-28 09:29:09', '1', NULL);
INSERT INTO "public"."subprocess_tb" VALUES (17, 7, 107, 'test201', '2024-04-05', '2024-04-06', NULL, '1', '2024-02-22 03:47:10', '2024-02-28 09:29:09', '1', NULL);
INSERT INTO "public"."subprocess_tb" VALUES (15, 1, 2, 'test1', '2023-12-22', '2023-12-26', '2023-12-26', '2', '2024-02-20 06:53:50', '2024-02-20 06:53:50', '1', NULL);
INSERT INTO "public"."subprocess_tb" VALUES (8, 3, 40, 'ทดสอบsubprocess1', '2024-02-06', '2024-02-07', '2024-02-22', '2', NULL, NULL, '1', NULL);
INSERT INTO "public"."subprocess_tb" VALUES (9, 3, 40, 'ทดสอบsubprocess2', '2024-02-07', '2024-02-08', '2024-02-08', '2', NULL, NULL, '1', NULL);
INSERT INTO "public"."subprocess_tb" VALUES (1, 1, 57, 'gdsgdsgds', '2024-02-01', '2024-05-01', NULL, '1', '2024-01-29 07:37:29', '2024-01-29 07:37:29', '1', NULL);
INSERT INTO "public"."subprocess_tb" VALUES (2, 1, 70, 'gdsfgsdfgdsf', '2024-01-10', '2024-01-11', NULL, '1', '2024-01-29 08:30:44', '2024-01-29 08:30:44', '1', NULL);
INSERT INTO "public"."subprocess_tb" VALUES (3, 1, 70, 'gfsgsdfgdfs', '2024-01-11', '2024-01-11', NULL, '1', '2024-01-29 08:30:44', '2024-01-29 08:30:44', '1', NULL);
INSERT INTO "public"."subprocess_tb" VALUES (4, 1, 76, 'fgdf', '2024-01-03', '2024-01-04', NULL, '1', '2024-01-31 06:31:37', '2024-01-31 06:31:37', '1', NULL);
INSERT INTO "public"."subprocess_tb" VALUES (5, 1, 77, 'fgdf', '2024-01-03', '2024-01-04', NULL, '1', '2024-01-31 06:31:45', '2024-01-31 06:31:45', '1', NULL);
INSERT INTO "public"."subprocess_tb" VALUES (6, 1, 78, 'fgdf', '2024-01-03', '2024-01-04', NULL, '1', '2024-01-31 06:31:46', '2024-01-31 06:31:46', '1', NULL);
INSERT INTO "public"."subprocess_tb" VALUES (7, 1, 79, 'fgdf', '2024-01-03', '2024-01-04', NULL, '1', '2024-01-31 06:38:14', '2024-01-31 06:38:14', '1', NULL);
INSERT INTO "public"."subprocess_tb" VALUES (10, 1, NULL, 'gsfdsgedshtrshbrgstrsgdf', '2023-12-25', '2023-12-25', NULL, '1', '2024-02-16 08:58:12', '2024-02-16 08:58:12', NULL, NULL);
INSERT INTO "public"."subprocess_tb" VALUES (11, 1, NULL, 'gk;lbnlgblvnlkbnfrlknolrngol[erwnonore', '2023-12-25', '2023-12-25', NULL, '1', '2024-02-16 09:00:00', '2024-02-16 09:00:00', NULL, NULL);
INSERT INTO "public"."subprocess_tb" VALUES (12, 1, NULL, 'gk;lbnlgblvnlkbnfrlknolrngol[erwnonorhghgfhgfe', '2023-12-25', '2023-12-25', NULL, '1', '2024-02-16 09:02:06', '2024-02-16 09:02:06', NULL, NULL);
INSERT INTO "public"."subprocess_tb" VALUES (13, 1, NULL, 'fdsvfsbvcxcxvfbgndtfhtd', '2023-12-25', '2023-12-26', NULL, '1', '2024-02-16 09:02:39', '2024-02-16 09:02:39', NULL, NULL);
INSERT INTO "public"."subprocess_tb" VALUES (14, 1, 2, 'fdsvfsbvcxcxvfbgndtfhtd', '2023-12-25', '2023-12-25', NULL, '1', '2024-02-16 09:03:42', '2024-02-19 06:28:19', '1', '2024-02-19 13:28:19');
INSERT INTO "public"."subprocess_tb" VALUES (18, 1, 108, 'test91011', '2023-12-21', '2023-12-23', NULL, NULL, '2024-02-29 03:49:34', '2024-02-29 10:57:59', '1', NULL);
