## Tiny example

Build a list of three nodes:

```
head → [10] → [20] → [30] → null
```

- Insert `15` **after head**: rewire two pointers — **O(1)** if you already hold the node before the hole
- Find value `30` from head: walk `10 → 20 → 30` — **O(n)**
- Jump to “index 2” the way an array does: **not available** without walking

## Why lists feel different from arrays

Each node stores a value and a `next` pointer (doubly linked: also `prev`). Nodes need not sit in contiguous memory. Local splices are cheap; random access is not.

## Ops at a glance

| Op | Cost | Need |
|----|------|------|
| insert/delete after a known node | O(1) | pointer to that node |
| search by value / k-th node | O(n) | walk from head |
| access by index like `a[i]` | O(n) | no address formula |

## Trap

Keeping only `head`, then claiming “insert at position k is O(1)” like a vector append.

**Fix:** Without a pointer near the spot (or a tail for append-only), you walk first — that walk is O(n).

**Time (splice at known node):** O(1)  
**Time (search):** O(n)  
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
