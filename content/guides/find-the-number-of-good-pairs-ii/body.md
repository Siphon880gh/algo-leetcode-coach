## Harmonic sum

1. c1 = counts of nums1; c2 = counts of nums2[j] · k.
2. For each d in c2: for m = d, 2d, … ≤ max(nums1): ans += c2[d] · c1[m].

Examples → 5, 2. Checked against testing every pair on 500 random cases.

Testing every pair is 10^10 at n = m = 10^5. The answer reaches n · m = 10^10; use 64-bit.

Time: O(n + m + M log M), M = max(nums1)  
Space: O(M)

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
