## Inclusion–exclusion over multiples

1. c(g) = how many nums are multiples of g; exact[g] = C(c(g), 2) − Σ exact[m] over multiples m > g.
2. pre = prefix sums of exact.
3. Answer for q: the first g with pre[g] > q.

Examples → [1, 2, 2], [4, 2, 1, 1], [2, 2]. Checked against sorting every pair on 300 random cases.

Skipping the subtraction: example 2 → [1, 1, 1, 1]. Listing all pairs: about 5 · 10^9 for n = 10^5.

Time: O(M log M + q log M), M = max value  
Space: O(M)

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
