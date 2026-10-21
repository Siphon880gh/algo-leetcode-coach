## A key and a map

Keep `db = {}`.

- **Counter:** `idx += 1`, `db[str(idx)] = longUrl`, return `domain + str(idx)`. Simple and collision-free, but codes are guessable and grow in length.
- **Random key:** draw 6 characters from `[0-9a-zA-Z]` (62^6 ≈ 5.7e10 keys) until the key is unused; store and return it.

`decode` takes the part after the last `/` and returns `db[key]`. A reverse map `url → key` lets repeat encodes return the same short URL.

Hashing the URL (for example, taking part of a hash) also works if you handle collisions.

Do not "encode" by returning the URL itself or a reversible transform that is not shorter — it works for the judge but misses the point. Do not ignore collisions for random keys.

Time: O(L) per call for the URL string  
Space: O(total URL length)

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
