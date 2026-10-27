## Prefix differences

Let `s` be the running sum. A subarray ending here sums to `k` exactly when some earlier prefix equals `s − k`. Keep `cnt` of prefix sums seen so far, starting with `cnt[0] = 1` (the empty prefix). For each value: `s += x`, `ans += cnt[s − k]`, then `cnt[s] += 1`.

Contiguous Array (525) and Continuous Subarray Sum (523) use the same "prefix seen before" idea with different keys.

Do not use a sliding window — negative numbers mean the sum does not grow as the window grows. Do not record `s` before looking up `s − k`; with `k = 0` the subarray would be empty. Do not forget the `{0: 1}` seed.

Time: O(n)  
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
