## Tiny example

Five exam scores:

```
scores = [72, 88, 91, 65, 80]
```

- Read index `2` → `91` in **O(1)** (address = base + 2 × element_size)
- Insert `99` at index `2` → every later score shifts right one slot → **O(n)**

That is the array tradeoff: **random read is cheap; mid-insert/delete is expensive.**

## Why contiguous memory matters

Element `i` lives at `base + i × size`. No pointer chase. Walking `0 … n−1` streams through cache lines.

A linked list of the same five scores needs a pointer hop per step to reach index 2.

## Ops at a glance

| Op | Cost | Why |
|----|------|-----|
| `a[i]` | O(1) | Address arithmetic |
| append at end (fixed capacity) | O(1) | Write next free slot |
| insert/delete at index `k` | O(n) | Shift the tail |
| search unsorted value | O(n) | Scan |

## Trap

Treating “arrays are always fast” as “every update is O(1)”.

**Fix:** Index reads are O(1). Shifting for a hole in the middle is O(n). Dynamic arrays also pay occasional growth copies on append.

**Time (index read):** O(1)  
**Time (mid-insert):** O(n)  
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
