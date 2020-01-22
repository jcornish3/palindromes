CREATE SEQUENCE palindrome_id_seq
  START WITH 1
  INCREMENT BY 1
  NO MINVALUE
  NO MAXVALUE
  CACHE 1;

CREATE TABLE palindrome (
  id integer DEFAULT nextval(('palindrome_id_seq'::text)::regclass) NOT NULL,
  supplied_value character varying(255) NOT NULL,
  palindrome boolean NOT NULL DEFAULT false,
  created TIMESTAMP WITH TIME ZONE NOT NULL,
  modified TIMESTAMP WITH TIME ZONE
);
