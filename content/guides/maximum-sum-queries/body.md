## Offline sweep

1. Sort (nums1, nums2) pairs by nums1 descending; sort queries by x descending; compress nums2.
2. For each query: add every pair with `nums1 ≥ x` into a Fenwick tree of suffix maxima at its nums2 rank.
3. Answer = max over ranks with `nums2 ≥ y`, or −1.

Examples → [6, 10, 7], [9, 9, 9], [−1]. Checked against scanning every index on 400 random cases.

Scanning all indices per query is n · q = 10^10 steps. Sums reach 2 · 10^9, past a signed 32-bit int.

Time: O((n + q) log n)  
Space: O(n + q)

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
