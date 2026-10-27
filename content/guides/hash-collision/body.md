## Tiny example

The table has capacity **4**. For this demo, both keys **A** and **E** hash to bucket 2.

```
Empty table: [ _, _, _, _ ]
```

Insert **A**. It goes in bucket 2: `[ _, _, A, _ ]`

Insert **E**. It also hashes to bucket 2, so the keys collide.

There are two standard fixes:

- **Chaining:** bucket 2 holds a small list containing A and then E. The other buckets stay empty.
- **Open addressing with linear probing:** slot 2 is full, so try slot 3, which is free. Place E there: `[ _, _, A, E ]`.

With open addressing, deletes need care. If you delete A by simply emptying slot 2, a later lookup for E starts at slot 2, sees an empty slot, and wrongly reports that E is missing.

## How

1. Hash the key to a bucket.
2. On a collision, either add the key to that bucket's chain, or probe other slots until you find a free one.
3. When deleting with open addressing, leave a tombstone marker so later probes keep going.
4. Keep the load factor low by resizing, so chains and probe runs stay short.

## Trap

Deleting by writing "empty" into the middle of a probe sequence.

**Fix:** Use a tombstone, or re-insert the rest of the cluster, so later keys can still be found.

**Lookup:** expected O(1) when the table is lightly loaded; it gets closer to O(n) as chains grow

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
