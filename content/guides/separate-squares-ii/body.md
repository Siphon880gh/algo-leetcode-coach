## Area of the union

1. Events (y, x1, x2, +1) and (y + l, x1, x2, −1), sorted by y.
2. Segment tree over sorted x-coordinates: cover count and covered length per node.
3. Store each strip (y_lo, y_hi, width); total = Σ width · height.
4. In the strip where the running area reaches total / 2: answer y_lo + (total / 2 − before) / width.

Examples → 1, 1. Checked against a unit-cell grid with exact fractions on 300 random cases.

Counting overlaps twice (part I): example 2 → 7 / 6 instead of 1.

Time: O(n log n)  
Space: O(n)

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
