## Tiny example

Sort `[3, 1, 4, 2]` with heap sort (max-heap).

1. Build a max-heap → heap-ish order, root holds the maximum (`4`)
2. Swap root with the end → `4` sits in final place; shrink heap size
3. Sift down the new root; repeat

Each extract grows the sorted suffix on the right.

## How

1. `heapify` the array in O(n)
2. For `end` from `n-1` down to `1`:
   - Swap `a[0]` with `a[end]`
   - Sift down at index `0` in the heap of size `end`

## Trap

Claiming build-heap is O(n log n) *and* therefore heap sort is slower than that alone suggests — the build is **O(n)**; the n extracts cost **O(n log n)** total.

**Fix:** Remember: build O(n), each sift O(log n), n times → **O(n log n)** time, **O(1)** extra space (not stable).

**Time:** O(n log n)  
**Space:** O(1) extra

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
