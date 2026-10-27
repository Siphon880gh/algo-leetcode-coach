## Tiny example

A table maps student IDs to names:

| key   | value |
|-------|-------|
| 12836 | Ada   |
| 15937 | Lin   |
| 16750 | Sam   |

You need the name for ID `15937`.

- Scanning a list compares every key, which is O(n).
- A hash table computes `bucket = hash(15937) % capacity`, jumps to that bucket, and checks the key. That is expected **O(1)**.

If another ID lands in the same bucket (a collision), that bucket holds a short chain, or the table probes nearby slots. You still **compare keys** until you find `15937` and return `Lin`.

## Why it is fast

An array gives O(1) access by a numeric index. A hash table **makes up** an index from any key. Keep the load factor (`n / capacity`) low so the chains stay short.

## Common operations

1. `put`, `get` and `remove` take expected O(1). In the worst case, when every key collides, they take O(n).
2. Iterating over all entries takes O(capacity + n).
3. When the table gets too full, resize it by rehashing everything into a larger table. This is amortized O(1) per insert.

## Trap

Using a mutable object as a key, inserting it, and then changing a field that the hash or equality depends on.

**Fix:** Prefer keys that cannot change, such as integers, strings or frozen tuples. Otherwise the table looks in the key's *new* bucket and misses the old entry.

**Time:** expected O(1) per operation  
**Space:** O(capacity)

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
