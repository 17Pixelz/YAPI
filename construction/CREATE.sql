CREATE TABLE motscles(
        mc_id  Int NOT NULL AUTO_INCREMENT,
        mc     Varchar (255) NOT NULL ,
        rech_d Datetime NOT NULL ,
        dep_d  Date ,
        fin_d  Date
	,CONSTRAINT motscles_PK PRIMARY KEY (mc_id)
);

CREATE TABLE chaines(
        ch_id    Varchar (50) NOT NULL ,
        ch_name  Varchar (50) NOT NULL ,
        ch_desc  Varchar (255) NOT NULL ,
        cre_date Date NOT NULL ,
        ch_vues  Int NOT NULL ,
        ch_abo   Int NOT NULL
	,CONSTRAINT chaines_PK PRIMARY KEY (ch_id)
);

CREATE TABLE videos(
        v_id     Varchar (50) NOT NULL ,
        v_titre  Varchar (255) NOT NULL ,
        v_desc     Text NOT NULL ,
        pub_date Date NOT NULL ,
        n_vues   Int NOT NULL ,
        n_comm   Int NOT NULL ,
        v_j      Int NOT NULL ,
        v_jnp    Int NOT NULL ,
        ch_id    Varchar (50) NOT NULL
	,CONSTRAINT videos_PK PRIMARY KEY (v_id)

	,CONSTRAINT videos_chaines_FK FOREIGN KEY (ch_id) REFERENCES chaines(ch_id)
);

CREATE TABLE commentaires(
        com_id     Varchar (50) NOT NULL ,
        com        Text NOT NULL ,
        date_com   Date NOT NULL ,
        com_nbr    Int NOT NULL ,
        com_j      Int NOT NULL ,
        com_parent Varchar (50) ,
        v_id       Varchar (50) NOT NULL ,
        ch_id      Varchar (50) NOT NULL
	,CONSTRAINT commentaires_PK PRIMARY KEY (com_id)

	,CONSTRAINT commentaires_videos_FK FOREIGN KEY (v_id) REFERENCES videos(v_id)
	,CONSTRAINT commentaires_chaines0_FK FOREIGN KEY (ch_id) REFERENCES chaines(ch_id)
        ,CONSTRAINT commentaires_commentaires_FK FOREIGN KEY (com_parent) REFERENCES commentaires(com_id)
);

CREATE TABLE contiennent(
        mc_id Int NOT NULL ,
        v_id  Varchar (50) NOT NULL
	,CONSTRAINT contiennent_PK PRIMARY KEY (mc_id,v_id)

	,CONSTRAINT contiennent_motscles_FK FOREIGN KEY (mc_id) REFERENCES motscles(mc_id)
	,CONSTRAINT contiennent_videos0_FK FOREIGN KEY (v_id) REFERENCES videos(v_id)
);