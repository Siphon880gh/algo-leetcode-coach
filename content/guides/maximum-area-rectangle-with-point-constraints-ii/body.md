## Sweep by x

1. Compress y; sort points by (x, y).
2. For each column x, add its points to a Fenwick tree over y, then for each consecutive pair (y1, y2) in the column:
   - c = points so far with y1 ≤ y ≤ y2;
   - if the pair was seen at column x′ with stored count c′, the box [x′, x] × [y1, y2] holds c − c′ points; if that is 4, update the area;
   - store (x, c − 2) for the pair.
3. Answer the largest area, or −1.

Examples → 4, −1, 2. Checked against brute force on 1,500 random point sets.

Skipping the count and trusting the pairs alone: example 2 → 4 instead of −1.

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
