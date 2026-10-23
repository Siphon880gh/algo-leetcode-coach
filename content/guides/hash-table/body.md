## Tiny example

Student IDs → names:

| key   | value |
|-------|-------|
| 12836 | Ada   |
| 15937 | Lin   |
| 16750 | Sam   |

Need the name for id `15937`.

- Array / list scan: compare every key → O(n)
- Hash table: `bucket = hash(15937) % capacity`, jump to that bucket, match the key → expected **O(1)**

If another id lands in the same bucket (collision), that bucket holds a short chain (or probe list). You still **compare keys** until you find `15937` → `Lin`.

## Why it is fast

Arrays give O(1) by numeric index. A hash table **manufactures** an index from an arbitrary key. Keep the load factor (`n / capacity`) bounded so chains stay short.

## Common ops

1. `put` / `get` / `remove` — expected O(1); worst O(n) if everything collides
2. Iterate all entries — O(capacity + n)
3. Resize when load is too high — rehash into a larger table (amortized)

## Trap

Use a mutable object as a key, insert it, then change a field that `hash` / `equals` depend on.

**Fix:** Prefer immutable keys (ints, strings, frozen tuples). The table will look in the *new* bucket and miss the old entry.

**Time:** expected O(1) per op  
**Space:** O(capacity)

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
