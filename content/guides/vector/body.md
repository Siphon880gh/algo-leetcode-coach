## Tiny example (growth)

A C++ `vector` or a Java `ArrayList` holds `[10, 20]` with **capacity 2**. You append `30`. The capacity is full, so the structure has to grow before it can write:

1. Allocate a new buffer with capacity 4 (doubling is typical).
2. Copy `10` and `20` into the new buffer.
3. Write `30` into the next free slot, giving `[10, 20, 30, _]`.

After that, the next few appends are cheap until the capacity fills up again. Doubling keeps **n appends at amortized O(1)** each, or O(n) in total.

## Where inserting in the middle shows up

Some interview problems rebuild an order by **inserting at index `k`**. One example is "queue reconstruction by height", where each person `[h, k]` wants exactly `k` people who are as tall or taller in front of them. In a contiguous vector, every insert in the middle **shifts everything after it**. That costs O(n) per insert, so **n inserts cost O(n²)** if you are not careful.

This is a different skill from growing by doubling. Growth is about *appending when the buffer is full*. Rebuilding by height is about *inserting in the middle*.

## Trap

Treating "insert at index `k`" as O(1) because appending felt cheap after doubling.

**Fix:** Appends are amortized O(1) thanks to growth. Inserts in the middle still shift elements, so count that cost, or use a structure with fast ordered inserts when the constraints require it.

**Time (n appends with doubling):** O(n)  
**Time (n naive inserts in the middle):** O(n²)  
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
