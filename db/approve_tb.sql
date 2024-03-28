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

 Date: 12/03/2024 16:23:14
*/


-- ----------------------------
-- Table structure for approve_tb
-- ----------------------------
DROP TABLE IF EXISTS "public"."approve_tb";
CREATE TABLE "public"."approve_tb" (
  "approve_id" int4 NOT NULL DEFAULT nextval('approve_tb_approve_id_seq'::regclass),
  "job_id" int4 NOT NULL,
  "approve_date" date,
  "reject_detail" text COLLATE "pg_catalog"."default",
  "status" varchar COLLATE "pg_catalog"."default",
  "approve_create" timestamp(6)
)
;

-- ----------------------------
-- Records of approve_tb
-- ----------------------------
INSERT INTO "public"."approve_tb" VALUES (1, 1, '2024-01-18', 'test', '1', NULL);
INSERT INTO "public"."approve_tb" VALUES (2, 3, '2024-01-19', 'ojfgikdnslkjf', '1', NULL);
