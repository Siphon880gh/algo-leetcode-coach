## Count, then group by count

Count every character with a hash map (at most 62 distinct keys). Sort the distinct characters by count, descending, and append each character `count` times. Sorting at most 62 keys is constant work, so the whole thing is linear in `n`.

Bucket sort avoids the sort entirely: make buckets `0..n`, put each character in `bucket[count]`, then walk buckets from `n` down to 1.

Top K Frequent Elements (347) returns the top `k` values, not a rebuilt string. Sort Array by Increasing Frequency (1636) sorts the other way with value tie-breaks.

Do not sort the raw string by a per-character count key without grouping — equal counts from different characters can interleave (`"cacaca"`). Do not lowercase the input.

Time: O(n) (plus sorting at most 62 keys)  
Space: O(n) for the output

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
