## Tiny example

Five exam scores:

```
scores = [72, 88, 91, 65, 80]
```

- Reading index `2` gives `91` in **O(1)**. The address is base + 2 × element_size.
- Inserting `99` at index `2` moves every later score one slot to the right, which is **O(n)**.

That is the array tradeoff: **reading any index is cheap, and inserting or deleting in the middle is expensive.**

## Why contiguous memory matters

Element `i` lives at `base + i × size`, so there is no pointer to follow. Walking from `0` to `n − 1` reads memory in order, which the cache handles well.

A linked list holding the same five scores needs one pointer hop per step to reach index 2.

## Costs at a glance

| Operation | Cost | Why |
|----|------|-----|
| `a[i]` | O(1) | Address arithmetic |
| Append at the end (capacity left) | O(1) | Write the next free slot |
| Insert or delete at index `k` | O(n) | Shift the tail |
| Search for a value (unsorted) | O(n) | Scan |

## Trap

Believing "arrays are fast" means every update is O(1).

**Fix:** Index reads are O(1). Opening a hole in the middle means shifting, which is O(n). Dynamic arrays also pay for an occasional copy when they grow on append.

**Time (index read):** O(1)  
**Time (insert in the middle):** O(n)  
**Space:** O(n)

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
