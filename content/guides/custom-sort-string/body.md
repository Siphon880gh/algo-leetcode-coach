## Counting sort with a custom alphabet

1. `cnt` = letter counts of `s`.
2. For each `c` in `order`: append `c · cnt[c]` and set `cnt[c] = 0`.
3. Append every remaining letter with its count.

The letters in `order` are unique, so each one is written once as a block.

A comparison sort with key `rank[c]` (letters not in `order` get any rank, such as 26) also works in O(n log n).

Do not drop the letters missing from `order`; they must still appear. Do not sort `order` itself; its sequence is the custom alphabet.

Time: O(|s| + |order|)  
Space: O(1) (26 counters)

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
