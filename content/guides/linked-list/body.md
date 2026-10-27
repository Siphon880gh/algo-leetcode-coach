## Tiny example

Build a list of three nodes:

```
head → [10] → [20] → [30] → null
```

- Insert `15` **after the head**. You rewire two pointers, which is **O(1)** when you already hold the node before the gap.
- Find the value `30` starting from the head. You walk through 10, 20 and then 30, which is **O(n)**.
- Jump straight to "index 2" the way an array does. This is **not possible** without walking.

## Why lists feel different from arrays

Each node stores a value and a `next` pointer. A doubly linked list also stores `prev`. The nodes do not have to sit next to each other in memory. Local splices are cheap, but random access is not.

## Operations at a glance

| Operation | Cost | What you need |
|-----------|------|---------------|
| insert or delete after a known node | O(1) | a pointer to that node |
| search by value, or find the k-th node | O(n) | a walk from the head |
| access by index, like `a[i]` | O(n) | there is no address formula |

## Trap

Keeping only `head`, then claiming that inserting at position k is O(1), like appending to a vector.

**Fix:** Without a pointer near the spot (or a tail pointer, for appends), you have to walk there first, and that walk is O(n).

**Time (splice at a known node):** O(1)  
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
