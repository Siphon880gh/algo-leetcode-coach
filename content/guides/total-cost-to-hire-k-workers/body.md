## Two pointers feeding a heap

1. Push `(cost, index)` for the first `candidates` workers, advancing `l`, then for up to `candidates` from the back, moving `r` down, never crossing `l`.
2. Repeat `k` times: pop the smallest; add its cost. If `l ≤ r`, push `l++` when the popped index was below `l`, else push `r−−`.
3. Return the total.

Examples → 11, 4. Checked against a direct simulation on 500 random cases.

The index in the tuple breaks ties toward the smaller index. Once the pointers cross, every remaining worker is in the heap and nothing is refilled. Totals reach 10^5 · 10^5 = 10^10, so use 64-bit.

Time: O((candidates + k) log candidates)  
Space: O(candidates)

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
