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

 Date: 12/03/2024 16:23:35
*/


-- ----------------------------
-- Table structure for job_tb
-- ----------------------------
DROP TABLE IF EXISTS "public"."job_tb";
CREATE TABLE "public"."job_tb" (
  "job_name" text COLLATE "pg_catalog"."default",
  "job_id" int4 NOT NULL DEFAULT nextval('"job_tb_job_id,_seq"'::regclass),
  "job_end" date,
  "job_start" date,
  "job_finish" date,
  "status" varchar COLLATE "pg_catalog"."default" NOT NULL,
  "datetimes" date,
  "division_id" int4,
  "updated_at" timestamp(6),
  "created_at" timestamp(6),
  "deleted_at" timestamp(6),
  "delete_flag" int4
)
;

-- ----------------------------
-- Records of job_tb
-- ----------------------------
INSERT INTO "public"."job_tb" VALUES ('test2', 18, '2024-02-17', '2024-02-16', NULL, '1', NULL, NULL, '2024-02-16 02:37:44', '2024-02-16 09:37:38', '2024-02-16 09:37:44', 0);
INSERT INTO "public"."job_tb" VALUES ('จัดทำร่าง พ.ร.ฎ. เสนอ รมว. ลงนามเพื่อส่ง สลค.', 2, '2024-01-01', '2024-01-02', NULL, '2', NULL, 1, NULL, NULL, NULL, 1);
INSERT INTO "public"."job_tb" VALUES ('สคก.ตรวจพิจารณาร่าง พ.ร.ฎ.', 4, '2024-01-16', '2024-01-19', NULL, '2', NULL, 1, NULL, NULL, NULL, 1);
INSERT INTO "public"."job_tb" VALUES ('จัดทำแผนที่ท้ายร่าง พ.ร.ฎ.', 1, '2023-12-26', '2023-12-21', NULL, '2', NULL, 1, '2024-02-29 10:49:08', NULL, NULL, 1);
INSERT INTO "public"."job_tb" VALUES ('เสนอ ครม.ให้ความเห็นชอบ', 6, '2024-03-13', '2024-04-11', NULL, '2', NULL, 1, NULL, NULL, NULL, 1);
INSERT INTO "public"."job_tb" VALUES ('สำรวจข้อมูลพื้นที่ที่จะทำการประกาศฯ ', 16, '2024-04-12', '2024-04-05', NULL, '2', NULL, 2, NULL, NULL, NULL, 1);
INSERT INTO "public"."job_tb" VALUES ('เสนอเรื่องจากส่วนภูมิภาคในจังหวัดมายังกรมอุทยานฯ เพื่อให้ความเห็นชอบ ', 17, '2024-04-13', '2024-04-05', NULL, '2', NULL, 2, NULL, NULL, NULL, 1);
INSERT INTO "public"."job_tb" VALUES ('ส.ป.ก.แก้ไขแผนที่ท้ายร่าง พ.ร.ฎ.', 5, '2024-02-29', '2024-02-17', NULL, '2', NULL, 1, NULL, NULL, NULL, 1);
INSERT INTO "public"."job_tb" VALUES ('testapprove1', 23, '2024-04-30', '2024-04-01', '2024-05-01', '3', '2024-03-07', 1, NULL, NULL, NULL, 1);
INSERT INTO "public"."job_tb" VALUES ('testapprove2', 24, '2024-04-30', '2024-04-01', '2024-05-03', '3', '2024-03-07', 2, NULL, NULL, NULL, 1);
INSERT INTO "public"."job_tb" VALUES ('เสนอ ครม.อนุมัติหลักการ', 3, '2024-01-02', '2024-01-02', NULL, '2', NULL, 1, '2024-02-22 10:03:52', NULL, NULL, 1);
INSERT INTO "public"."job_tb" VALUES ('นำขึ้นทูลเกล้าฯ ประกาศในราชกิจจานุเบกษา', 7, '2024-04-10', '2024-04-05', NULL, '2', NULL, 1, '2024-02-22 10:12:01', NULL, NULL, 1);

-- ----------------------------
-- Primary Key structure for table job_tb
-- ----------------------------
ALTER TABLE "public"."job_tb" ADD CONSTRAINT "job_tb_pkey" PRIMARY KEY ("job_id");
