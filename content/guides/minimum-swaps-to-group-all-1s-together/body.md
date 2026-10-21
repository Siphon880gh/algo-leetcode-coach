Given a binary array, return the minimum number of swaps needed to put all of its 1s next to each other anywhere in the array. For instance, `[1,0,1,0,1]` needs 1 swap and `[0,0,0,1,0]` needs 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Window of length k

1. `k = sum(data)`. If `k ≤ 1`, return 0.
2. `ones` = the number of 1s in `data[0:k]`, and `best = ones`.
3. For `i` from `k` to `n − 1`: `ones += data[i] − data[i − k]`, then `best = max(best, ones)`.
4. Return `k − best`.

Each 0 inside the chosen window needs exactly one swap with a 1 outside it.

Do not try every target window with a fresh count; the sliding update makes it O(n). Do not count swaps by moving 1s step by step; a swap can move a 1 any distance.

Time: O(n)  
Space: O(1)

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
