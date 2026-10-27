## Remove open islands, count the rest

1. For every border cell with 0, flood-fill its island, setting cells to 1.
2. For every remaining 0, count one island and flood-fill it.
3. Return the count.

The first example has 2 closed islands; the second has 1.

Do not swap the meaning of 0 and 1; in this problem 0 is land. Do not stop a fill when it reaches the border mid-way and count it anyway; clearing border islands first avoids that bookkeeping.

Time: O(rows · cols)  
Space: O(rows · cols) for the fill stack

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
