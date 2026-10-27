## Split each query

1. Two pointers give L[j]. P = prefix sums of j − L[j] + 1.
2. For [l, r]: p = first j in [l, r] with L[j] ≥ l (binary search). With m = p − l, answer = m(m + 1)/2 + P[r + 1] − P[p].

Examples → [26], [15, 9, 3]. Checked against brute force on 300 random strings with three queries each.

Using j − L[j] + 1 without clamping the start at l: example 2 → [15, 11, 6]. Brute force per query can reach 10^5 · 10^5 = 10^10.

Time: O(n + q log n)  
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
