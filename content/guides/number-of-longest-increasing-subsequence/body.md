## Two arrays

`len[i]` is the longest increasing subsequence ending at `i`. `cnt[i]` is how many subsequences reach that length. Both start at 1.

For each `j < i` with `nums[j] < nums[i]`:

- `len[j] + 1 > len[i]`: set `len[i] = len[j] + 1` and `cnt[i] = cnt[j]`.
- `len[j] + 1 == len[i]`: `cnt[i] += cnt[j]`.

The answer is the sum of `cnt[i]` over every `i` with `len[i] == max(len)`.

For O(n log n), use a segment tree or BIT over compressed values that stores a (length, count) pair per value and merges by max length, adding counts on ties.

Do not count only one ending index; several indexes can end a longest subsequence. Do not add `cnt[j]` when the length grows; replace it.

Time: O(n²)  
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
