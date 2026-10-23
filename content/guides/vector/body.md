## Tiny example (growth)

A C++ `vector` / Java `ArrayList` starts as `[10, 20]` with **capacity 2**. You append `30`. Capacity is full, so the structure must grow before writing:

1. Allocate a new buffer with capacity 4 (typical doubling)
2. Copy `10` and `20` into the new buffer
3. Write `30` at the next free slot → `[10, 20, 30, _]`

After that, a few more appends are cheap until capacity fills again. Doubling keeps **n appends amortized O(1)** each (total O(n)).

## Where mid-insert shows up

Some interview problems rebuild an order by **inserting at index `k`** (for example “people by height”: each person `[h, k]` wants `k` taller-or-equal people in front). With a contiguous vector, every mid-insert **shifts the tail** — O(n) per insert, so **n inserts → O(n²)** if you are not careful.

That is a different skill from growth-by-doubling. Growth is about *append when full*; rebuild-by-height is about *insert in the middle*.

## Trap

Treating “insert at index `k`” as O(1) because append felt cheap after doubling.

**Fix:** Appends after growth are amortized O(1). Mid-inserts still shift elements — count that cost, or use a structure that supports fast ordered inserts when constraints force it.

**Time (n appends with doubling):** O(n)  
**Time (n naive mid-inserts):** O(n²)  
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
