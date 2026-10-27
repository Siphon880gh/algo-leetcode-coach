## Only decrease from the top

1. Replace odd `x` with `2x`; push all into a max-heap; `mn = min`.
2. Loop: pop `x`; `best = min(best, x − mn)`; if `x` is odd, stop; else push `x / 2` and update `mn`.

`[1,2,3,4]` → 1. `[4,1,5,20,3]` → 3. `[2,10,8]` → 3.

After doubling, every value can only go down, so shrinking the maximum is the only useful move. Do not try halving the minimum.

Time: O(n log n log M)  
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
