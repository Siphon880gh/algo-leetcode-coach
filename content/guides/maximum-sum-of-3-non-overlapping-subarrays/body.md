## Fix the middle

1. `W[i]` = the sum of `nums[i … i + k − 1]`, from prefix sums.
2. `left[i]` = the index of the best `W` among `0 … i`. On ties, keep the **earlier** index (update only on `>`).
3. `right[i]` = the index of the best `W` among `i … end`. On ties, keep the earlier index too (scanning from the right, update on `≥`).
4. For each middle start `j` from `k` to `len(W) − 1 − k`: `a = left[j − k]`, `b = right[j + k]`. Score `W[a] + W[j] + W[b]`, and keep the best triple, updating only on `>`.

That keeps the lexicographically smallest answer among ties, as required.

Do not try all triples; that is O(n³). Do not get the tie rules wrong; `[1,2,1,2,6,7,5,1]`, `k = 2` → `[0,3,5]`.

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
