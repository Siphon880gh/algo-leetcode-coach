## Tiny example

Table capacity **4**. Hash(key) = first letter’s alphabet index mod 4.

```
A → 0 mod 4 = 0?  (use demo: both A and E hash to bucket 2)
Empty table: [ _, _, _, _ ]
```

Insert **A** → bucket 2: `[ _, _, A, _ ]`

Insert **E**, also bucket 2 — collision.

**Chaining:** bucket 2 holds a list `[A → E]`. Other buckets stay empty.

**Open addressing (linear probe):** try slot 2 (full) → slot 3 → place E: `[ _, _, A, E ]`

Later, if you **blank** slot 2 on delete (turn A into `_`) without a tombstone, a lookup for E may stop at the hole and wrongly say “missing”.

## How

1. Hash to a bucket
2. On collision: chain in-bucket **or** probe other slots
3. On open-address delete: mark tombstone so probes continue
4. Keep load factor bounded (resize) so chains/probes stay short

## Trap

Deleting by writing “empty” in the middle of a probe sequence.

**Fix:** Tombstones (or rehash the cluster) so later keys remain reachable.

**Lookup:** expected O(1) at low load; degrades toward O(n) if chains grow

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
