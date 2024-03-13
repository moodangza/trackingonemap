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

 Date: 12/03/2024 16:23:46
*/


-- ----------------------------
-- Table structure for statusjob_tb
-- ----------------------------
DROP TABLE IF EXISTS "public"."statusjob_tb";
CREATE TABLE "public"."statusjob_tb" (
  "status_job_id" int4 NOT NULL DEFAULT nextval('statusjob_tb_status_job_id_seq'::regclass),
  "status_job_name" varchar COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of statusjob_tb
-- ----------------------------
INSERT INTO "public"."statusjob_tb" VALUES (1, 'อยู่ระหว่างดำเนินการ');
INSERT INTO "public"."statusjob_tb" VALUES (2, 'ดำเนินการเสร็จสิ้น');

-- ----------------------------
-- Indexes structure for table statusjob_tb
-- ----------------------------
CREATE UNIQUE INDEX "statusjob_tb_status_job_id_idx" ON "public"."statusjob_tb" USING btree (
  "status_job_id" "pg_catalog"."int4_ops" ASC NULLS LAST
);
