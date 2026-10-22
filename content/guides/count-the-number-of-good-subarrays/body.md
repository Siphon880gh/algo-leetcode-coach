## Pairs in a window

1. `pairs = 0`, `l = 0`, `ans = 0`.
2. For each `r`: `pairs += cnt[x]`; `cnt[x]++`.
3. While `pairs ≥ k`: `cnt[nums[l]]−−`; `pairs −= cnt[nums[l]]`; `l++`.
4. `ans += l`.

Examples → 1, 4. Checked against counting pairs in every subarray on 300 random arrays.

Extending a good subarray keeps it good, so after shrinking, the starts 0 … l − 1 are exactly the good ones for this end. The answer can reach about 5 · 10^9, so use 64-bit.

Time: O(n)  
Space: O(n)

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
