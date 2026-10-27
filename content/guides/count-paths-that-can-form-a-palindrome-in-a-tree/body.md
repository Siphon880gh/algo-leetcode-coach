## Masks

1. `mask[0] = 0`; `mask[i] = mask[parent[i]] XOR (1 << (s[i] − 'a'))`, visiting parents first.
2. For each node: add `cnt[m]` plus `cnt[m XOR (1 << c)]` for the 26 letters; then `cnt[m] += 1`.
3. Return the total.

Examples → 8, 10. Checked against testing every pair’s path on 300 random trees.

The shared part above the meeting point cancels in the XOR, so the masks describe exactly the path. Matching only equal masks misses odd-length palindromes: example 1 → 1 instead of 8. Use an explicit stack, since the tree can be a path of 10^5 nodes, and 64-bit counts (up to about 5 · 10^9).

Time: O(26 n)  
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
