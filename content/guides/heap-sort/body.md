## Tiny example

Sort `[3, 1, 4, 2]` with heap sort, using a max-heap.

1. Build a max-heap. The root now holds the maximum, `4`.
2. Swap the root with the last slot. Now `4` is in its final place, so shrink the heap by one.
3. Sift the new root down, then repeat.

Each round grows a sorted section on the right side of the array.

## How

1. Heapify the array in O(n).
2. For `end` from `n − 1` down to `1`:
   - Swap `a[0]` with `a[end]`.
   - Sift down from index `0` inside the heap of size `end`.

## Trap

Thinking the build step is O(n log n) and adding that on top of the rest. The build is **O(n)**. The n extractions cost **O(n log n)** in total.

**Fix:** The build is O(n), and each of the n sift-downs is O(log n). Heap sort takes **O(n log n)** time and **O(1)** extra space, and it is not stable.

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
