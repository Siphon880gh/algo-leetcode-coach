## Segment tree

1. Each node stores its first peak, its last peak, and A = Σ (ps − p(s−1)) · ps over consecutive peaks inside it.
2. Merge: A = A_left + A_right + (first_right − last_left) · first_right.
3. Query [l + 1, r − 1] for (p1, pt, A). The answer is r · (pt − l) − ((p1 − l) · p1 + A), or 0 with no peak.
4. Update: set the value, then recompute peaks at index − 1, index and index + 1.

Examples → [2, 0], [1, 0], [0, 3]. Matched counting every subarray on 1,500 random cases. Counts reach about 5 · 10^9, so use 64-bit integers.

Adding (k − l) · (r − k) for each peak separately counts subarrays with two peaks twice: constructed check (run in code) [1, 3, 1, 3, 1], query [1, 0, 4] → 6 instead of 5.

Time: O((n + q) log n)  
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
