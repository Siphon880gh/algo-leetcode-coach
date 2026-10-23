## Tiny example

Sort `[3, 1, 4, 2]` ascending with bubble sort.

Pass 1 (compare neighbors left→right):

1. `3,1` → swap → `[1, 3, 4, 2]`
2. `3,4` → ok
3. `4,2` → swap → `[1, 3, 2, 4]`

Largest value `4` has “bubbled” to the end. Later passes ignore the frozen suffix.

After more passes: `[1, 2, 3, 4]`.

## How

1. For pass `i` from `0 … n-2`
2. Scan `j` from `0 … n-2-i`
3. If `a[j] > a[j+1]`, swap
4. Optional: stop early if a pass does zero swaps

## Trap

Thinking every “swap sort” is O(n log n).

**Fix:** Bubble is **O(n²)** comparisons/swaps in the worst and average case (best O(n) with the early-stop flag on sorted input).

**Time:** O(n²) typical · **Space:** O(1)

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
