Given a list of feature words and a list of user responses (space-separated words), a feature's popularity is the number of responses that mention it, counted at most once per response. Return the features sorted by popularity, most popular first, keeping the original order on ties. For instance, features [cooler, lock, touch] with responses ["i like cooler cooler", "lock touch cool", "locker like touch"] → [touch, cooler, lock]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Distinct words per response

1. For each response: `for w in set(response.split()): cnt[w] += 1`.
2. Sort features by `(−cnt[f], index of f)`.

Constructed checks (verified with code): the example above → `[touch, cooler, lock]`; features `[a, aa, b, c]` with responses `["a", "a aa", "a a a a a", "b a"]` → `[a, aa, b, c]`.

Use the set: repeating a word in one response must not raise its count. Match whole words; `locker` does not mention `lock`.

Time: O(total words + f log f)  
Space: O(distinct words)

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
