## Segments

1. seg = start of each maximal non-decreasing segment; s = prefix sums of k(k + 1)/2.
2. For [l, r]: i = first segment start > l, j = last start ≤ r.
3. If i > j: answer k(k + 1)/2 with k = r − l + 1. Else a = seg[i] − l, b = r − seg[j] + 1, answer a(a + 1)/2 + (s[j] − s[i]) + b(b + 1)/2.

Examples → [2, 3, 4], [3, 1]. Checked against counting every subarray on 1,500 random arrays.

Counting whole segments that touch [l, r] without cutting them: example 1, query [0, 1] → 4 instead of 2.

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
