## DP

1. cost(i, d): d = 0 → impossible if s1[i] = 1 and s2[i] = 0, else [s1[i] ≠ s2[i]]. d ≥ 1 → [s1[i] = 0] + (d − 1) + [s2[i] = 1].
2. p_i ∈ {0, 1} says whether pair (i, i + 1) is cleared; d_i = p_{i − 1} + p_i.
3. dp over p_{i − 1}: add p_i + cost(i, d_i). Return the minimum, or −1.

Examples → 1, 3, −1. Matched breadth-first search over all strings for every pair of strings with n ≤ 7; clearing a pair twice never helps there. Edge checks: 10^5 ones to zeros → 50,000; 10^5 zeros to ones → 100,000.

Only pairing a 1 with the next index: example 2 → −1 instead of 3.

Time: O(n)  
Space: O(1)

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
