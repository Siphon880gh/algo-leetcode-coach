## Two flattenings

1. H = row-major text, V = column-major text.
2. Find every match start in each with the Z-function of pattern + separator + text.
3. Mark [start, start + len) with a difference array.
4. Count cells (i, j) covered at H[i · n + j] and at V[j · m + i].

Examples → 1, 4, 1. Checked against marking matches directly on 300 random grids.

Not letting matches wrap to the next row or column: example 1 → 0 instead of 1.

Time: O(m · n + |pattern|)  
Space: O(m · n + |pattern|)

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
