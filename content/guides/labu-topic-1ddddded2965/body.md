## Tiny example

Three tools for linked lists, shown on `1→2→3→4`:

1. **A dummy head** placed before `1` makes deleting the head, or handling an empty list, work like any other case.
2. **Fast and slow pointers**: fast moves two nodes per step and slow moves one. When fast reaches the end, slow is at the middle, for both odd and even lengths.
3. **Safe rewiring**: save `nxt = cur.next` before you change any pointer.

Most linked-list bugs come from losing a `next` reference.

## How

1. Draw the pointers before writing code.
2. Use a dummy node whenever the head might change.
3. Save `next` before rewiring.

## Trap

Changing `cur.next` before saving the old next node. The rest of the list is lost.

**Fix:** Save it in a temporary variable first, then rewire.

**Time:** O(n) for the usual walks · **Space:** O(1) for these pointer tricks

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
