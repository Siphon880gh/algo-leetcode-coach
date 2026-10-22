## Prefix set

1. For each x in arr1: while x > 0, add x to the set and x = x / 10 (integer division).
2. For each y in arr2: while y > 0 and y is not in the set, y = y / 10. If y > 0, candidate = number of digits of y.
3. Return the best candidate, or 0.

Examples → 3, 0. Checked against comparing every pair digit by digit on 3,000 random inputs.

Every pair is up to 2.5 · 10^9 comparisons; the set needs at most 8 prefixes per number.

Time: O((n + m) · 8)  
Space: O(8 n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
