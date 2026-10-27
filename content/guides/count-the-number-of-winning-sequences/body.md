## Score-gap DP

1. dp[(last, d)] = ways; for each round and each b ≠ last, add the round’s +1, 0 or −1 to d.
2. Answer Σ dp with d > 0, mod 10^9 + 7.

Examples → 3, 18. Checked against every sequence on 100 random strings.

Allowing repeats: example 1 → 10 instead of 3. About 1.8 · 10^7 transitions for n = 1000.

Time: O(n² · 9)  
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
