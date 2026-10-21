Binary array `nums`, length 1 to 1e5. Return the longest run of 1s you can get by flipping at most one 0. `[1,0,1,1,0]` → 4. `[1,0,1,1,0,1]` → 4. Follow-up: the input is an infinite stream and you cannot store it. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Window with at most one zero

Grow `r`. Count zeros in `[l, r]`. While the count is 2, move `l` forward (dropping a zero when you pass one). The answer is the widest window seen. Each index enters and leaves once.

Streaming version: keep `prev` = length of the 1s run before the last zero, and `cur` = length of the run since it. On a 1, `cur += 1`. On a 0, `prev = cur + 1` (the old run plus the flipped zero), `cur = 0`. Track `max(prev + cur)`. No array is stored.

Max Consecutive Ones (485) allows no flips. Max Consecutive Ones III (1004) allows `k` flips — the same window with `k` instead of 1. Longest Repeating Character Replacement (424) is the letter version.

Do not try flipping each zero and rescanning (O(n²)). Do not forget an all-ones array — the answer is its length, with no flip needed.

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
