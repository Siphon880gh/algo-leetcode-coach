## Doubling tables

1. `up[x]` = receiver[x], `sm[x]` = receiver[x] (one pass).
2. For each bit of k: if set, add `sm[cur[x]]` to x’s score and move `cur[x] = up[cur[x]]`; then double: `sm[x] += sm[up[x]]`, `up[x] = up[up[x]]`.
3. Return the best `x + score[x]`.

Examples → 6, 10. Checked against simulating every pass on 300 random inputs.

k reaches 10^10, so simulating is far too slow, and about 34 doublings suffice. Scores reach about 10^15, so use 64-bit.

Time: O(n log k)  
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
