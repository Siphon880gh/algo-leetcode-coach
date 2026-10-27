## LEFT JOIN, not INNER JOIN

Dungeon Game is grid DP. This is the first Database problem: keep the left table whole.

Start from `Person`. `LEFT JOIN Address` on `personId` (SQL `USING (personId)` or `ON Person.personId = Address.personId`). Project `firstName`, `lastName`, `city`, `state`. A left join emits a Person row even when Address has no match; the Address columns become `NULL`. An inner join would drop Allen Wang. Do not `JOIN` only on people who already have an address.

Pandas: `person.merge(address, how="left", on="personId")` then the same four columns. Same meaning as SQL left join.

**Time:** O(P + A) with a hash on `personId`  
**Space:** O(P + A) for the join result

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
