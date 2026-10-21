## Sums of the set

Let `S = sum(set(nums))`:

- `duplicate = sum(nums) − S` (the duplicate is counted twice in the full sum)
- `missing = n(n + 1) / 2 − S`

**Counting:** one pass to count, then the value with count 2 is the duplicate and the value with count 0 is missing.

**O(1) space:** mark by sign. For each value `v`, look at index `|v| − 1`; if it is already negative, `|v|` is the duplicate, otherwise negate it. Afterward, the index still positive gives the missing value. XOR of everything with `1..n` gives `dup ⊕ missing`, which can be split by one set bit.

Do not assume the array is sorted; `[3,2,2]` has the duplicate in the middle and 1 missing. Return `[duplicate, missing]` in that order.

Time: O(n)  
Space: O(n), or O(1) with sign marks

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
