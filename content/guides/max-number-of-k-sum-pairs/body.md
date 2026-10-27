## Match on the fly

1. `cnt = Counter()`, `pairs = 0`.
2. For `x`: if `cnt[k − x] > 0`, decrement it and `pairs += 1`; else `cnt[x] += 1`.
3. Return `pairs`.

`[1,2,3,4]`, 5 → 2. `[3,1,3,4,3]`, 6 → 1.

Each element is used at most once; greedy matching is optimal because any complement pairing is interchangeable. Do not count pairs by index combinations.

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
